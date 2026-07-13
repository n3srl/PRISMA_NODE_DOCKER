FROM debian:bookworm-slim

RUN apt-get update && apt-get install -y --no-install-recommends \
        openssh-server \
    && rm -rf /var/lib/apt/lists/* \
    && mkdir -p /run/sshd \
    && useradd -m -s /bin/bash prisma

COPY sshd_config /etc/ssh/sshd_config

RUN ssh-keygen -A

EXPOSE 2026

CMD ["/usr/sbin/sshd", "-D", "-e"]
