# BinaryTree

## Description

TODO

## Installation

The system is installed automatically. The necessary components are automatically installed as well.
In order for the installation to start, enter the following commands in the project console window.

After the installation is complete, the virtual machine will be available at 192.168.100.104

```sh
$ chmod x+ ./install/prepare_enviroment.sh
$ ./install/prepare_enviroment.sh
$ vagrant up
```

Note: The installation may take several minutes for the first time due to the creation of the virtual machine and the configuration of the required components.

## Getting into vagrant

```sh
$ vagrant ssh
```

## Tests
To run tests, execute the following line of code in the project console window inside vagrant.

```sh
$ phpunit
```