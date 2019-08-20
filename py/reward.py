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


EPISODE_PER_ITER = 20
fname = '/deepracer/logs/robomaker.log'
data = load_data(fname)
df = convert_to_pandas(data, EPISODE_PER_ITER)


REWARD_THRESHOLD = 10

# reward graph per episode
min_episodes = np.min(df['episode'])
max_episodes = np.max(df['episode'])
# print('Number of episodes = ', max_episodes)

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
        max_reward_per_iteration.append(np.max(buffer_rew) / 4)
        deviation_reward_per_iteration.append(np.std(buffer_rew))
        # reset
        buffer_rew = list()
        
if len(buffer_rew) > 0:
    average_reward_per_iteration.append(np.mean(buffer_rew))
    max_reward_per_iteration.append(np.max(buffer_rew) / 4)
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
        
fig = plt.figure(figsize=(8,20))
ax = fig.add_subplot(411)
ax.plot(np.arange(len(average_reward_per_iteration)), average_reward_per_iteration, marker='.', linewidth=1, markersize=5)
# ax.plot(np.arange(len(max_reward_per_iteration)), max_reward_per_iteration, marker='.', linewidth=1, markersize=5, color='green')
ax.set_title('Rewards per Iteration')
ax.set_ylabel('Mean reward')
ax.set_xlabel('Iteration')

for rr in range(len(average_reward_per_iteration)):
    if average_reward_per_iteration[rr] >= REWARD_THRESHOLD :
        ax.plot(rr, average_reward_per_iteration[rr], 'r.')

plt.grid(True)

ax = fig.add_subplot(412)
ax.plot(np.arange(len(avg_progress_per_iteration)), avg_progress_per_iteration, marker='.', linewidth=1, markersize=5)
ax.plot(np.arange(len(max_progress_per_iteration)), max_progress_per_iteration, marker='.', linewidth=1, markersize=5, color='green')
ax.plot(np.arange(len(count_progress_per_iteration)), count_progress_per_iteration, marker='.', linewidth=1, markersize=5, color='purple')
ax.set_title('Progress per Iteration')
ax.set_ylabel('progress')
ax.set_xlabel('Iteration')

for rr in range(len(average_reward_per_iteration)):
    if average_reward_per_iteration[rr] >= REWARD_THRESHOLD :
        ax.plot(rr, avg_progress_per_iteration[rr], 'r.')
        ax.plot(rr, max_progress_per_iteration[rr], 'r.')

plt.grid(True)

ax = fig.add_subplot(413)
ax.plot(np.arange(len(deviation_reward_per_iteration)), deviation_reward_per_iteration, marker='.', linewidth=1, markersize=5)

ax.set_ylabel('Dev of reward')
ax.set_xlabel('Iteration')
plt.grid(True)

for rr in range(len(average_reward_per_iteration)):
    if average_reward_per_iteration[rr] >= REWARD_THRESHOLD:
        ax.plot(rr, deviation_reward_per_iteration[rr], 'r.')


ax = fig.add_subplot(414)
ax.plot(np.arange(len(total_reward_per_episode)), total_reward_per_episode, '.')
ax.set_ylabel('Total reward')
ax.set_xlabel('Episode')

plt.savefig('image.png')