FROM node:10
WORKDIR /usr/src/app
COPY package*.json ./
RUN npm install -g @quasar/cli
RUN npm install -g @vue/cli-init
RUN npm install pm2@latest -g
RUN npm install
COPY . .
RUN quasar build -m spa
EXPOSE 8080
CMD [ "quasar", "serve", "./dist/spa", "80", "-p", "80", "&"]