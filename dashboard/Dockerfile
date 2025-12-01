FROM n3srl/docker-lamp
# ---- 1. Install git ----
RUN apt update && \
    apt install -y git && \
    rm -rf /var/lib/apt/lists/*

# ---- 2. Install git-lfs ----
RUN apt update && \
	apt install -y nano && \
    apt install -y curl && \
    apt install -y git-lfs && \
    rm -rf /var/lib/apt/lists/*

# Install Python
RUN apt update && \
    apt install -y python3 python3-pip && \
    rm -rf /var/lib/apt/lists/*

# Inizializing database
COPY data/prisma_dump.sql /db/dump.sql
COPY scripts/init.sql /db/init.sql
RUN chmod u+x /db/init.sql

# Copy repository PRISMA_DAHSBOARD
COPY PRISMA_DASHBOARD/ /app/

CMD ["/run.sh"]
