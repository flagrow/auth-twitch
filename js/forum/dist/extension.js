'use strict';

System.register('flagrow/auth-twitch/main', ['flarum/extend', 'flarum/app', 'flarum/components/LogInButtons', 'flarum/components/LogInButton'], function (_export, _context) {
  "use strict";

  var extend, app, LogInButtons, LogInButton;
  return {
    setters: [function (_flarumExtend) {
      extend = _flarumExtend.extend;
    }, function (_flarumApp) {
      app = _flarumApp.default;
    }, function (_flarumComponentsLogInButtons) {
      LogInButtons = _flarumComponentsLogInButtons.default;
    }, function (_flarumComponentsLogInButton) {
      LogInButton = _flarumComponentsLogInButton.default;
    }],
    execute: function () {

      app.initializers.add('flagrow-auth-twitch', function () {
        extend(LogInButtons.prototype, 'items', function (items) {
          items.add('twitch', m(
            LogInButton,
            {
              className: 'Button twitch',
              icon: 'twitch',
              path: '/auth/twitch' },
            app.translator.trans('flagrow-twitch.forum.log_in_with_twitch_button')
          ));
        });
      });
    }
  };
});