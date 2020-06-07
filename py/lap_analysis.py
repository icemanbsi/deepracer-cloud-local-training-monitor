#!/usr/bin/python
import json
import math
import time
import numpy as np
import pandas as pd
import matplotlib
matplotlib.use('Agg')
import matplotlib.pyplot as plt
from datetime import datetime
import os
# %matplotlib inline

#Shapely Library
from shapely.geometry import Point, Polygon
from shapely.geometry.polygon import LinearRing, LineString

import track_utils as tu
import log_analysis as la
# import cw_utils as cw

config = None
with open('config.txt') as json_file:
    config = json.load(json_file)

EPISODES_PER_ITERATION = 60
NUM_EPOCH = 10
fname = '/deepracer/logs/robomaker.log'
sname = '/deepracer/logs/sagemaker.log'
track_name = "reinvent_base"

if config is not None:
    EPISODES_PER_ITERATION = config['num_episodes_between_training']
    NUM_EPOCH = config['num_epoch']
    fname = config['robomaker_log_path']
    sname = config['sagemaker_log_path']
    track_name = config['track_name']

l_center_line, l_inner_border, l_outer_border, road_poly = tu.load_track(track_name, absolute_path=os.getcwd())

data = la.load_data(fname)
df = la.convert_to_pandas(data, episodes_per_iteration=EPISODES_PER_ITERATION)
df = df.sort_values(['episode', 'steps'])


#training progress
simulation_agg = la.simulation_agg(df)
la.analyze_training_progress(simulation_agg, title='Training progress')

#stats all laps
la.scatter_aggregates(simulation_agg, 'Stats for all laps')


#complete lap only
complete_ones = simulation_agg[simulation_agg['progress']==100]
if complete_ones.shape[0] > 0:
    la.scatter_aggregates(complete_ones, 'Stats for complete laps')
else:
    print('No complete laps yet.')

# View ten best rewarded episodes in the training
simulation_agg.nlargest(10, 'reward')

# View five fastest complete laps
complete_ones.nsmallest(5, 'time')

# Fetch information about the car's episodes and plot some of them
action_map, episode_map, sorted_idx = la.episode_parser(data)
# highest reward for complete laps:
# sorted_idx = list(complete_ones.nlargest(3,'reward')['episode'])
# highest progress from all episodes:
# sorted_idx = list(simulation_agg.nlargest(3,'progress')['episode'])
fig = la.plot_top_laps(sorted_idx[:],  episode_map, l_center_line, l_inner_border, l_outer_border, 5)