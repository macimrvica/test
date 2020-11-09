ARG NODE_VERSION=14.4.0

FROM node:${NODE_VERSION}-alpine AS symfony_node

WORKDIR /app

ENV PATH /app/node_modules/.bin:$PATH

COPY ./frontend/package*.json ./

RUN npm install --silent
RUN npm install react-scripts@3.4.1 -g --silent

CMD ["npm", "start"]
