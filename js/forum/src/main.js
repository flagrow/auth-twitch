import { extend } from 'flarum/extend';
import app from 'flarum/app';
import LogInButtons from 'flarum/components/LogInButtons';
import LogInButton from 'flarum/components/LogInButton';

app.initializers.add('flagrow-auth-twitch', () => {
  extend(LogInButtons.prototype, 'items', function(items) {
    items.add('twitch',
      <LogInButton
        className="Button twitch"
        icon="twitch"
        path="/auth/twitch">
        {app.translator.trans('flagrow-twitch.forum.log_in_with_twitch_button')}
      </LogInButton>
    );
  });
});
