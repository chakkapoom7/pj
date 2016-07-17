#!/bin/bash
#
# test This starts and stops test
#
# chkconfig: 2345 12 88
# description: test is YYYYYYYYYYYYYYYYYYY
# processname: test
# pidfile: /var/run/test.pid
### BEGIN INIT INFO
# Provides: $test
### END INIT INFO

# Source function library.
. /etc/init.d/functions

binary="/etc/psulogsys/test"

[ -x $binary ] || exit 0

RETVAL=0

start() {
    echo -n "Starting test: "
    daemon $binary
    RETVAL=$?
    PID=$!
    echo
    [ $RETVAL -eq 0 ] && touch /var/lock/subsys/test

    echo $PID > /var/run/test.pid
}

stop() {
    echo -n "Shutting down test: "
    killproc test
    RETVAL=$?
    echo
    if [ $RETVAL -eq 0 ]; then
        rm -f /var/lock/subsys/test
        rm -f /var/run/test.pid
    fi
}

restart() {
    echo -n "Restarting test: "
    stop
    sleep 2
    start
}

case "$1" in
    start)
        start
    ;;
    stop)
        stop
    ;;
    status)
        status test
    ;;
    restart)
        restart
    ;;
    *)
        echo "Usage: $0 {start|stop|status|restart}"
    ;;
esac

exit 0