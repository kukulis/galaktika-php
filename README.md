# web game

## xdebug

activate command line

    export XDEBUG_SESSION=1

## overlaping tests issue

If SingletonsContainer is used, better to call SingletonsContainer::instance()->cleanContainer(); before preparing portion of the test data.