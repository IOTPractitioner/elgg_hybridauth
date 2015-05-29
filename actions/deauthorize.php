<?php

$provider = get_input('provider');

$guid = get_input('guid');
$user = get_entity($guid);

if (!$provider || !$user) {
	forward('', '404');
}

$ha_session = new \Elgg\HybridAuth\Session($user);
$ha_provider = $ha_session->getProvider($provider);

if (!$ha_provider) {
	forward('', '404');
}

if ($ha_session->deauthenticate($ha_provider)) {
	system_message(elgg_echo('hybridauth:provider:user:deauthorized'));
} else {
	register_error(elgg_echo('hybridauth:provider:user:deauthorized:error'));
}

forward(REFERER);
