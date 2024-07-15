FROM n3srl/docker-lamp
# env
ARG MYSQL_PRISMA_PWD
# build env
ENV MYSQL_PRISMA_PWD=${MYSQL_PRISMA_PWD}
# Inizializing database
COPY data/prisma_dump.sql /db/dump.sql
COPY scripts/init.sql /db/init.sql
RUN chmod u+x /db/init.sql
# Initializing app
COPY appdata /app
RUN rm -rf /app/config/config.php
COPY config/config.php /app/config/config.php 
CMD ["/run.sh"]
