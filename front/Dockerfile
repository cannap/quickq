# Datei: front/Dockerfile

# Verwenden Sie das offizielle node-Image als Basis
FROM node:latest

# Arbeitsverzeichnis im Container setzen
WORKDIR /app

# Kopieren Sie die package.json und package-lock.json zuerst,
# um die Vorteile des Docker Caching zu nutzen.
COPY package*.json ./

# Installieren Sie die Projektabhängigkeiten
RUN npm ci

# Kopieren Sie den Rest des Codes
COPY . .

# Setzen Sie die Umgebungsvariable für den Entwicklungsmodus
ENV NODE_ENV=development

# Starten Sie den Entwicklungs-Server
CMD ["npm", "run", "dev"]