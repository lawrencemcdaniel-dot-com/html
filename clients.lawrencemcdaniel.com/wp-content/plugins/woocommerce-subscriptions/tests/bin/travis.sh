#!/usr/bin/env bash
# usage: travis.sh before|after

if [[ "$2" == "7.0" ]]
then
  wget -c https://phar.phpunit.de/phpunit-5.7.phar
  chmod +x phpunit-5.7.phar
  mv phpunit-5.7.phar `which phpunit`
fi

if [ $1 == 'before' ]; then

	# place a copy of woocommerce where the unit tests etc. expect it to be
	git clone --depth 1 --branch $WC_VERSION git@github.com:woocommerce/woocommerce.git '../woocommerce'

	#if [ "$TRAVIS_PHP_VERSION" != "5.2" ] && [ "$TRAVIS_PHP_VERSION" != "5.3" ] ; then

		# set the travis job number as the site id for the acceptance tests
	#	sed -ie "s/%{site_id}/$TRAVIS_JOB_NUMBER/g" tests/acceptance.suite.yml

		# fire up a test site
	#	curl -X GET "http://gimme.subscription.beer/?action=up&key=DAzaEguw8j8BDs&id=$TRAVIS_JOB_NUMBER&wp=$WP_VERSION&wc=$WC_VERSION&wcs=$TRAVIS_BRANCH"

	#fi

fi
