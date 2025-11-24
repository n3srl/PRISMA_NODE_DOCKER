FROM n3srl/docker-lamp
# env
ARG MYSQL_PRISMA_PWD
# build env
ENV MYSQL_PRISMA_PWD=${MYSQL_PRISMA_PWD}
# Inizializing database
COPY data/prisma_dump.sql /db/dump.sql
COPY scripts/init.sql /db/init.sql
RUN chmod u+x /db/init.sql

# Clone repository PRISMA_DAHSBOARD
RUN rm -rf /app && \
    git clone https://github.com/n3srl/PRISMA_DAHSBOARD.git /app

CMD ["/run.sh"]
