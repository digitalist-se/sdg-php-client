BUILDCONFDIR=SDG-Api-build
GENERATECMD=php vendor/bin/jane-openapi generate --config-file

all: statistics uniqueid feedbackquality feedbackqualitysurvey

statistics: $(BUILDCONFDIR)/statistics-information.yml $(BUILDCONFDIR)/janeconf-statistics-information.php
	$(GENERATECMD) $(BUILDCONFDIR)/janeconf-statistics-information.php

uniqueid: $(BUILDCONFDIR)/unique-id.yml $(BUILDCONFDIR)/janeconf-unique-id.php
	$(GENERATECMD) $(BUILDCONFDIR)/janeconf-unique-id.php

feedbackquality: $(BUILDCONFDIR)/feedback-quality.yml $(BUILDCONFDIR)/janeconf-feedback-quality.php
	$(GENERATECMD) $(BUILDCONFDIR)/janeconf-feedback-quality.php

feedbackqualitysurvey: $(BUILDCONFDIR)/feedback-quality-survey.yml $(BUILDCONFDIR)/janeconf-feedback-quality-survey.php
	$(GENERATECMD) $(BUILDCONFDIR)/janeconf-feedback-quality-survey.php
