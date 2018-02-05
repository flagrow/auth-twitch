var gulp = require('flarum-gulp');

gulp({
  modules: {
    'flagrow/auth-twitch': ['src/**/*.js']
  }
});
