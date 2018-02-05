'use strict';

System.register('flagrow/auth-twitch/components/TwitchSettingsModal', ['flarum/components/SettingsModal'], function (_export, _context) {
  "use strict";

  var SettingsModal, TwitchSettingsModal;
  return {
    setters: [function (_flarumComponentsSettingsModal) {
      SettingsModal = _flarumComponentsSettingsModal.default;
    }],
    execute: function () {
      TwitchSettingsModal = function (_SettingsModal) {
        babelHelpers.inherits(TwitchSettingsModal, _SettingsModal);

        function TwitchSettingsModal() {
          babelHelpers.classCallCheck(this, TwitchSettingsModal);
          return babelHelpers.possibleConstructorReturn(this, (TwitchSettingsModal.__proto__ || Object.getPrototypeOf(TwitchSettingsModal)).apply(this, arguments));
        }

        babelHelpers.createClass(TwitchSettingsModal, [{
          key: 'className',
          value: function className() {
            return 'TwitchSettingsModal Modal--small';
          }
        }, {
          key: 'title',
          value: function title() {
            return app.translator.trans('flagrow-twitch.admin.title');
          }
        }, {
          key: 'form',
          value: function form() {
            return [m(
              'div',
              { className: 'Form-group' },
              m(
                'label',
                null,
                app.translator.trans('flagrow-twitch.admin.client_id_label')
              ),
              m('input', { className: 'FormControl', bidi: this.setting('flagrow-twitch.client_id') })
            ), m(
              'div',
              { className: 'Form-group' },
              m(
                'label',
                null,
                app.translator.trans('flagrow-twitch.admin.client_secret_label')
              ),
              m('input', { className: 'FormControl', bidi: this.setting('flagrow-twitch.client_secret') })
            )];
          }
        }]);
        return TwitchSettingsModal;
      }(SettingsModal);

      _export('default', TwitchSettingsModal);
    }
  };
});;
'use strict';

System.register('flagrow/auth-twitch/main', ['flarum/app', './components/TwitchSettingsModal'], function (_export, _context) {
  "use strict";

  var app, TwitchSettingsModal;
  return {
    setters: [function (_flarumApp) {
      app = _flarumApp.default;
    }, function (_componentsTwitchSettingsModal) {
      TwitchSettingsModal = _componentsTwitchSettingsModal.default;
    }],
    execute: function () {

      app.initializers.add('flagrow-auth-twitch', function () {
        app.extensionSettings['flagrow-auth-twitch'] = function () {
          return app.modal.show(new TwitchSettingsModal());
        };
      });
    }
  };
});