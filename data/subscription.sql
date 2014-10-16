CREATE TABLE IF NOT EXISTS subscription (
	id TEXT NOT NULL DEFAULT '' PRIMARY KEY,
	topic_url TEXT DEFAULT NULL,
	hub_url TEXT DEFAULT NULL,
	created_time TEXT DEFAULT NULL,
	lease_seconds INTEGER DEFAULT NULL,
	verify_token TEXT DEFAULT NULL,
	secret TEXT DEFAULT NULL,
	expiration_time TEXT DEFAULT NULL,
	subscription_state TEXT DEFAULT NULL
);
