BUILDCONFDIR=SDG-Api-build
GENERATECMD=php vendor/bin/jane-openapi generate --config-file

all: statistics uniqueid

statistics: $(BUILDCONFDIR)/statistics-information.yml $(BUILDCONFDIR)/janeconf-statistics-information.php
	$(GENERATECMD) $(BUILDCONFDIR)/janeconf-statistics-information.php

uniqueid: $(BUILDCONFDIR)/unique-id.yml $(BUILDCONFDIR)/janeconf-unique-id.php
	$(GENERATECMD) $(BUILDCONFDIR)/janeconf-unique-id.php
