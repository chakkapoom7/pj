#!/bin/bash
#
# log_relation This starts and stops log_relation
#
# chkconfig: 2345 12 88
# description: log_relation is YYYYYYYYYYYYYYYYYYY
# processname: log_relation
# pidfile: /var/run/log_relation.pid
### BEGIN INIT INFO
# Provides: $log_relation
### END INIT INFO

# Source function library.
. /etc/init.d/functions

binary="/path/to/log_relation"

[ -x $binary ] || exit 0

RETVAL=0

start() {
    echo -n "Starting log_relation: "
    daemon $binary
    RETVAL=$?
    PID=$!
    echo
    [ $RETVAL -eq 0 ] && touch /var/lock/subsys/log_relation

    echo $PID > /var/run/log_relation.pid
}

stop() {
    echo -n "Shutting down log_relation: "
    killproc log_relation
    RETVAL=$?
    echo
    if [ $RETVAL -eq 0 ]; then
        rm -f /var/lock/subsys/log_relation
        rm -f /var/run/log_relation.pid
    fi
}

restart() {
    echo -n "Restarting log_relation: "
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
        status log_relation
    ;;
    restart)
        restart
    ;;
    *)
        echo "Usage: $0 {start|stop|status|restart}"
    ;;
esac

exit 0