# webeng-project

Website about cctv services.
This project was made for final project of web engineering subject.

This project is using bootstrap. It is suggested to use node as package manager for this development because it's easier to manage, it can be downloaded in here https://nodejs.org/en/download/. For php development, composer is a great package manager and can be download in here https://getcomposer.org/

#Note
1. All dependency and dev-dependency on project can be installed by run `npm install` and `composer install` (if there is dependencies on composer.json)
2. Run `npm run live` for running live-server script which can run the server with live reload capability
3. `npm run scss` is to generate css file, `npm run watch` is an option to execute sass watcher command if using sass as css preprocessor
4. To install package from node run `npm install <package>`. But if possible, keeping track of what dependencies that are used in the project is really appreciated. It can be save on package.json by run `npm install <package> --save` || `npm install <package> --save-dev`
5. For installing php dependencies from composer, composer.json is needed. To initalize this file run `composer init` or it can be initialized automatically when installing packages
6. To install package from composer run `composer require <package> --dev` || `composer require <package>`
7. Php package also can be seen in https://getcomposer.org/
