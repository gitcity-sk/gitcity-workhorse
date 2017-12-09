FROM registry.gitcity.sk/cakehub/cakeapp:cli-no-db

COPY . /usr/src/unicorn
WORKDIR /usr/src/unicorn

COPY docker-entry.sh /usr/local/bin/docker-entry
RUN chmod +x /usr/local/bin/docker-entry

EXPOSE 18801

CMD ["docker-entry"]
