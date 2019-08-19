# Trip Builder

Trip builder is a simple application used to build/navigate trips using criteria such as departure locations, departure dates, and arrival locations. I used this project as a chance to become familiar with the Laravel framework as well as the Laravel Homestead environment.

Flight, airline, airport, and other data is stored in Homestead's local instance of MySQL. You'll need to install and configure Homestead, migrate the database tables, and insert the data from a provided `.sql` file to the database in order to run this application.

Please follow the steps below carefully.


##L inux (Ubuntu 18.04) setup instructions:


### Environment Setup Instructions

Please note that one step of this process involves downloading a laravel vagrant box: this step can take upwards of an hour depending on your connection.

1. If VirtualBox is not installed, install from a terminal using the following command:

    `sudo apt install virtualbox`.

2. Install vagrant (version 2.25). Use these commands to install, as ubuntu's version of vagrant could be a bit older and incompatible with the Homestead/Laravel version we're using for this project:
	
	`sudo wget https://releases.hashicorp.com/vagrant/2.2.5/vagrant_2.2.5_x86_64.deb`
	
	`sudo dpkg -i vagrant_2.2.5_x86_64.deb`
	
3. From vagrant, we want to start a new Homestead box. Note: this step will take some time as we must download this vagrant box.
	
	`vagrant box add laravel/homestead`
	
4. Install Homestead via git, and checkout the stable release branch:
	
	`git clone https://github.com/laravel/homestead.git ~/Homestead`
	
	`cd ~/Homestead`
	
	`git checkout release`
	
	Note: if git is not installed on this device, run `sudo apt install git` in the terminal.

5. Run the following command to initialize Homestead:
	
	`bash init.sh`

6. Edit the `Homestead.yaml` file in `~/Homestead`. There are a few important parts here, namely the `provider`, `folders` and `sites` sections:

    `provider: virtualbox`
    
    `
    folders:
        - map: ~/code/trip-builder
          to: /home/vagrant/code/trip-builder
    `
    
    `
    sites:      
        - map: trip-builder.localhost
          to: /home/vagrant/code/trip-builder/public
`

    Essentially we are mapping/sym-linking folders/sites from Ubuntu to the Homestead vagrant box. We will later download the `trip-builder` project to the `~/code/` directory.

7. Edit `/etc/hosts` to include a line for `trip-builder`:
	
	`192.168.10.10	trip-builder.localhost`
	
	Note: you may need root access here, using `sudo gedit /etc/hosts`

8. Once Homestead is setup, we are ready to start our Homestead environment:
	
	`cd ~/Homestead`
	
	`vagrant up`
    
    The vagrant instance should start. If you receive a message about checking your Homestead.yaml for ssh, either configure ssh or run `touch ~/.ssh/id_rsa` to generate an empty file.

9. Additional notes:
	- It's best to start from a non-virtual Ubuntu instance; while these install instructions are for Ubuntu 18.04, if (like me) you try to run ubuntu 18.04 as a virtual machine in Windows to then install vagrant/run Homestead on the virtual machine, vagrant may run into issues with VT-x.
	- These instructions/steps are similar on Windows, but the shell commands will be slightly different. I suggest using git-bash if you take this route.


### Install Instructions

1. Download `trip-builder` from the repository and store in in `~/code` using this command in your terminal:

    `git https://github.com/nickmacdonald7/trip-builder.git ~/code/trip-builder`

2. Run a composer update on our project from the vagrant box. First, run this vagrant command:

	`vagrant ssh`
	
	This will open a terminal in the vagrant box. In the vagrant terminal, navigate to:
	
	`cd ~/code/trip-builder`
	
	Finally, run this command to update composer dependencies:
	
	`composer update`
	
3. We'll need to migrate the database tables from the project to the vagrant box's mysql database. Run the following command from the `~/code/trip-builder` directory in the vagrant terminal:
	
	`php artisan migrate`
	
	This should populate the tables in the database.

4. Next, for our actual data, we will need to insert it from a mysql dump file. In the vagrant terminal from `~/code/trip-builder` enter this command:
	
	`mysql -u homestead -p homestead < database/dumps/2019_08_18_all_db_backup.sql`
	
	When it prompts for the password, type:
	
	`secret`
	
5. Additional notes:
	- MySql credentials are stored in the project's .env file. This is not something I'd usually store in git, but for simplicity's sake I left it here.

	- If you run into any weirdness with vagrant after changing any configurations, run `vagrant reload --provision` from your the `~/Homestead` directory in your terminal.


### Run Instructions
	
In a browser, navigate to http://trip-builder.localhost/

From the landing page, select a departure city, an arrival city, and a trip type (one way or round trip). Press "Start Building" to continue.

The next page will allow you to select a departure date (and if you chose round-trip, a return date). Press "Select Flights" to continue.

On the following page, you will see a list of available flights including their name, departure and arrival times, and prices. Depending on your trip type, select your flight(s), then press "Show my trip".

Finally, a page will appear with your itinerary and total cost. If you wish to go back to the first page and build another trip, press the "Build another Trip" button to do so.


## Notes

- Data for flights between various cities was intentionally left sparse in order to display instances where return flights or departure flights are not available.
- This was not intended as an exercise in front-end development, so please excuse the lack of polish in the layout.
