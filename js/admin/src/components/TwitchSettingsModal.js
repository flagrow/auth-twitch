import SettingsModal from 'flarum/components/SettingsModal';

export default class TwitchSettingsModal extends SettingsModal {
  className() {
    return 'TwitchSettingsModal Modal--small';
  }

  title() {
    return app.translator.trans('flagrow-twitch.admin.title');
  }

  form() {
    return [
      <div className="Form-group">
        <label>{app.translator.trans('flagrow-twitch.admin.client_id_label')}</label>
        <input className="FormControl" bidi={this.setting('flagrow-twitch.client_id')}/>
      </div>,

      <div className="Form-group">
        <label>{app.translator.trans('flagrow-twitch.admin.client_secret_label')}</label>
        <input className="FormControl" bidi={this.setting('flagrow-twitch.client_secret')}/>
      </div>
    ];
  }
}
