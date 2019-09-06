# AWS DeepRacer Cloud Local Training Monitor

#### This reposistory designed for getting insight of training progress.
#### !!! I haven't add any security to this project yet. Assuming if you are running in the cloud, you can limit the allowed IP Address through firewall. !!!

### SETUP
1. You need to enable or install Apache / Nginx and PHP
2. Put this code to the web server folder
3. Open the settings page, there is several items that you need to configure
	1. `number of episodes between iteration` : the DeepRacer hyperparameter according to your current settings.
	2. `robomaker log` : the robomaker log file path, please use absolute path.
	3. `sagemaker log` : the sagemaker log file path, please use absolute path.