# AWS DeepRacer Cloud Local Training Monitor

#### This reposistory designed for getting insight of training progress.
#### !!! I haven't add any security to this project yet. Assuming if you are running in the cloud, you can limit the allowed IP Address through firewall. !!!

### SETUP
1. You need to enable or install Apache / Nginx and PHP
2. Put this code to the web server folder
3. Clone the `config.txt.sample` and name it as `config.txt`
3. Open the settings page, there is several items that you need to configure
	1. `number of episodes between iteration` : the DeepRacer hyperparameter according to your current settings.
	2. `robomaker log` : the robomaker log file path, please use absolute path.
	3. `sagemaker log` : the sagemaker log file path, please use absolute path.

If you have trouble with running the python script, especially because of user or permission, for now I change the Apache runtime user and group. For more information about it, please read https://ubuntuforums.org/showthread.php?t=927142#post_5960549.

If you have a better solution, please let me know.