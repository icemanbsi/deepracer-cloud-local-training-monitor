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
sname = '/deepracer/logs/sagemaker.log'
sdata = load_sagemaker_data(sname)
sdf = convert_sagemaker_to_pandas(sdata, EPISODE_PER_ITER)

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
    
fig = plt.figure(figsize=(8,15))
ax = fig.add_subplot(311)
ax.plot(np.arange(len(entropy_list)), entropy_list, marker='.', linewidth=1, markersize=5)
# ax.plot(np.arange(len(max_reward_per_iteration)), max_reward_per_iteration, marker='.', linewidth=1, markersize=5, color='green')
ax.set_title('Entropy per Iteration')
ax.set_ylabel('Mean entropy')
ax.set_xlabel('Iteration')
plt.grid(True)

ax = fig.add_subplot(312)
ax.plot(np.arange(len(kl_divergence)), kl_divergence, marker='.', linewidth=1, markersize=5)
ax.set_title('KL Divergence per Iteration')
ax.set_ylabel('Mean kl_divergence')
ax.set_xlabel('Iteration')
plt.grid(True)

ax = fig.add_subplot(313)
ax.plot(np.arange(len(surrogate_loss)), surrogate_loss, marker='.', linewidth=1, markersize=5)
ax.set_title('Surrogate Loss per Iteration')
ax.set_ylabel('Mean surrogate_loss')
ax.set_xlabel('Iteration')
plt.grid(True)

plt.savefig('entropy.png')