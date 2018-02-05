import app from 'flarum/app';

import TwitchSettingsModal from './components/TwitchSettingsModal';

app.initializers.add('flagrow-auth-twitch', () => {
  app.extensionSettings['flagrow-auth-twitch'] = () => app.modal.show(new TwitchSettingsModal());
});
