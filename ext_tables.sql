CREATE TABLE tx_dinosaurfinder_dinosaur
(
	name           varchar(255) NOT NULL DEFAULT '',
	slug           varchar(2048),
	diet           varchar(255) NOT NULL DEFAULT '',
	size           float                 DEFAULT '0' NOT NULL,
	weight         float                 DEFAULT '0' NOT NULL,
	era            varchar(255) NOT NULL DEFAULT '',
	region         varchar(255) NOT NULL DEFAULT '',
	discovery_year int(11) unsigned      DEFAULT '0' NOT NULL,
	discoverer     varchar(255) NOT NULL DEFAULT '',
	group          varchar(255) NOT NULL DEFAULT '',
	image          INT UNSIGNED          DEFAULT 0 NOT NULL
);
