# behat-mink-windows-setup-2019
Minimal code to get started with behat php testing using mink on windows 10

## Requirements
1. Java runtime for windows

2. PHP - PHP 7.3.10 was used while testing

3. Composer - [download](https://getcomposer.org/Composer-Setup.exe)

4. Selenium Standalone server - [selenium-server-standalone-2.53.0](http://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.0.jar) was used while code testing because 3+ versions had some issues.

## Steps
1. Download and install all the requirements mentioned above and make sure that **Composer** is in the path environment variable of windows.

2. Run `composer install` in the same directory as composer.json (projects root directory) to install all the dependencies.

3. Run `bin\behat --init`

4. Place the downloaded selenium-server-standalone-*.jar file in selenium folder. 
    >If your selenium version is not 2.53.0 then edit the selenium.bat file accordingly
    
5. Double-click on selenium.bat. Now you are ready to start testing.

6. Run `bin\behat` to run your features defined in features folder.

## Tips
1. I have already defined few useful functions for reference in FeatureContext.php i.e. dropping a file in dropzone, waiting for element to appear etc.

2. You can run `bin\behat -dl` or `bin\behat -di` (more expressive) for the list of available definitions to use in your *.feature.

3. [Here](https://tentacode.dev/10-tips-with-behat-and-mink) is a nice post with useful compilation of tips.
