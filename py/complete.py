#!/usr/bin/python

import math
import time
import numpy as np
import pandas as pd
import matplotlib
matplotlib.use('Agg')
import matplotlib.pyplot as plt
from datetime import datetime
# %matplotlib inline

#Shapely Library
from shapely.geometry import Point, Polygon
from shapely.geometry.polygon import LinearRing, LineString

from log_analysis import *


EPISODE_PER_ITER = 40
fname = '/deepracer/logs/robomaker.log'
data = load_data(fname)
df = convert_to_pandas(data, EPISODE_PER_ITER)

sname = '/deepracer/logs/sagemaker.log'
sdata = load_sagemaker_data(sname)
sdf = convert_sagemaker_to_pandas(sdata, EPISODE_PER_ITER)


REWARD_THRESHOLD = 10

# reward graph per episode
min_episodes = np.min(df['episode'])
max_episodes = np.max(df['episode'])

total_reward_per_episode = list()
progress_per_episode = list()
for epi in range(min_episodes, max_episodes):
    df_slice = df[df['episode'] == epi]
    total_reward_per_episode.append(np.sum(df_slice['reward']))
    progress_per_episode.append(np.max(df_slice['progress']))

average_reward_per_iteration = list()
max_reward_per_iteration = list()
deviation_reward_per_iteration = list()
avg_progress_per_iteration = list()
max_progress_per_iteration = list()
count_progress_per_iteration = list()

buffer_rew = list()
for val in total_reward_per_episode:
    buffer_rew.append(val)

    if len(buffer_rew) == EPISODE_PER_ITER:
        average_reward_per_iteration.append(np.mean(buffer_rew))
        max_reward_per_iteration.append(np.max(buffer_rew))
        deviation_reward_per_iteration.append(np.std(buffer_rew))
        # reset
        buffer_rew = list()
        
if len(buffer_rew) > 0:
    average_reward_per_iteration.append(np.mean(buffer_rew))
    max_reward_per_iteration.append(np.max(buffer_rew))
    deviation_reward_per_iteration.append(np.std(buffer_rew))
        
buffer_raw = list()
for pgr in progress_per_episode:
    buffer_raw.append(pgr)

    if len(buffer_raw) == EPISODE_PER_ITER:
        avg_progress_per_iteration.append(np.mean(buffer_raw))
        max_progress_per_iteration.append(np.max(buffer_raw))
        count = 0
        for v in buffer_raw:
            if v >= 100:
                count += 1
        count_progress_per_iteration.append(count * 100 / EPISODE_PER_ITER)
        # reset
        buffer_raw = list()
        
if len(buffer_raw) > 0:
    avg_progress_per_iteration.append(np.mean(buffer_raw))
    max_progress_per_iteration.append(np.max(buffer_raw))
    count = 0
    for v in buffer_raw:
        if v >= 100:
            count += 1
    count_progress_per_iteration.append(count * 100 / EPISODE_PER_ITER)

    
min_iteration = np.min(sdf['iteration']) - 1
max_iteration = np.max(sdf['iteration']) + 1
    
entropy_list = list()
kl_divergence = list()
surrogate_loss = list()
for it in range(min_iteration, max_iteration):
    sdf_slice = sdf[sdf['iteration'] == it]
    entropy_list.append( np.mean(sdf_slice['entropy']) )
    kl_divergence.append( np.mean(sdf_slice['kl_divergence']) )
    surrogate_loss.append( np.mean(sdf_slice['surrogate_loss']) )

fig = plt.figure(figsize=(15,10))
ax = fig.add_subplot(111)
ln1 = ax.plot(np.arange(len(average_reward_per_iteration)), 
        average_reward_per_iteration, 
        marker='.', 
        linewidth=1, 
        markersize=5,
        color='blue')
ax.set_title('Rewards per Iteration')
ax.set_ylabel('Mean reward')
ax.set_xlabel('Iteration')
plt.grid(True)

ax2 = ax.twinx()
ln2 = ax2.plot(np.arange(len(avg_progress_per_iteration)), 
         avg_progress_per_iteration,
         marker='.', 
         linewidth=1, 
         markersize=5, 
         color='gold')
ln3 = ax2.plot(np.arange(len(max_progress_per_iteration)), 
         max_progress_per_iteration, 
         marker='.', 
         linewidth=1, 
         markersize=5, 
         color='green')
ln4 = ax2.plot(np.arange(len(count_progress_per_iteration)), 
         count_progress_per_iteration, marker='.', 
         linewidth=1, 
         markersize=5,
         color='pink')
ax2.set_title('Progress per Iteration')
ax2.set_ylabel('Progress / Entropy')
ax2.set_ylim(-10, 100)


ax3 = ax.twinx()
ln5 = ax3.plot(np.arange(len(entropy_list)), 
        entropy_list, 
        marker='.', 
        linewidth=1, 
        markersize=5,
        color='red')
# ax3.set_ylabel('entropy')
ax3.set_ylim(0, 4)


lns = ln1+ln2+ln3+ln4+ln5
plt.legend(lns, ['Mean Reward', 'Mean Progress', 'Max Progress', 'Complete Lap', 'Mean Entropy'], loc=2)

fig.tight_layout()
plt.savefig('complete.png')