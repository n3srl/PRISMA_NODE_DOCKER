FROM n3srl/docker-lamp
# env
ARG MYSQL_PRISMA_PWD
# build env
ENV MYSQL_PRISMA_PWD=${MYSQL_PRISMA_PWD}
# Inizializing database
COPY data/prisma_dump.sql /db/dump.sql
COPY scripts/init.sql /db/init.sql
RUN chmod u+x /db/init.sql

# Copy repository PRISMA_DAHSBOARD
COPY PRISMA_DASHBOARD/ /app/

CMD ["/run.sh"]
