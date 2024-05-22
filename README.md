# web game

## xdebug

activate command line

    export XDEBUG_SESSION=1

be carefull with:
PHP_IDE_CONFIG setting from the command line.

current 20-xdebug.ini content (working):
zend_extension=xdebug.so
xdebug.mode=debug
xdebug.remote_enable=true
xdebug.client_host=127.0.0.1

## overlaping tests issue

If SingletonsContainer is used, better to call SingletonsContainer::instance()->cleanContainer(); before preparing portion of the test data.