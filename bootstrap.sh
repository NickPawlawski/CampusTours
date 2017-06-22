# Configure apt for installing the correct packages and setting the right settings for MySQL.
# PHP PPA for installing an older version of PHP.
add-apt-repository ppa:ondrej/php

# MySQL Root Password trick. Must be before MySQL installation.
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

apt-get update

# Install MySQL.
apt-get install -y mysql-server mysql-client

# Install Apache and configure the directory to serve from.
apt-get install -y apache2

if ! [ -L /var/www ]; then
    rm -rf /var/www/html
    ln -fs /vagrant/public /var/www/html
fi

# Install PHP 5, PHP 5 apache module, and PHP modules.
apt-get install -y php5.6 php5.6-mysql libapache2-mod-php5.6 sqlite3
apt-get install -y php5.6-mcrypt php5.6-common php5.6-cli php5.6-ldap php5.6-json php5.6-xml php5.6-curl

# Setup MySQL database.
mysql -uroot -proot -e "CREATE DATABASE campustours"

# End of script. Add further commands as desired, e.g. creating a mysql database for the project.

# Source of mysql password trick: 
# https://unix.stackexchange.com/questions/147261/installing-mysql-server-in-vagrant-bootstrap-shell-script-how-to-skip-setup
# Source of PHP 5.6 PPA fix:
# https://askubuntu.com/questions/761713/how-can-i-downgrade-from-php-7-to-php-5-6-on-ubuntu-16-04/762161#762161
