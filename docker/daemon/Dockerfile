FROM alpine:latest

ARG NEW_RELIC_AGENT_VERSION

RUN apk add curl

RUN curl -L "https://download.newrelic.com/php_agent/archive/${NEW_RELIC_AGENT_VERSION}/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux-musl.tar.gz" | tar -C /tmp -zx \
 && export NR_INSTALL_SILENT=1 \
 && tmp/newrelic-php5-*/newrelic-install install_daemon \
 && rm -rf /tmp/newrelic-php5-* /tmp/nrinstall*

CMD /usr/bin/newrelic-daemon --address=$(hostname):31339  --watchdog-foreground