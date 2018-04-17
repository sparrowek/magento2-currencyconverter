define([
 	'ko',
 	'jquery',
 	'mage/translate'
], function(ko, $, $t) {
	return function(config, element) {
		var self = this;
		//model
		self.fromCurrency = 'RUB';
		self.toCurrency = 'PLN';
		self.inputValue = ko.observable('');
		self.outputValue = ko.observable('');

		//ui
		self.isLoading = ko.observable(false);
		self.errors = ko.observable('');

        //form submission
		self.convertCurrency = function() {
			self.errors('');
			self.isLoading(true);
			var data = ko.toJSON({
				inputCurrency: {
					currencyCode: self.fromCurrency,
					value: self.inputValue()
				},
				outputCurrencyCode: self.toCurrency
			});

			//call webAPI
			$.ajax({
				url: config.conversionServiceUrl,
				method: 'post',
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: data
			}).done(function(response) {
				if (response == null || response.value == null) {
					self.errors($t('Error during currency conversion!'));
				}
				else {
					self.outputValue(response.value);
				}
			}).always(function () {
                self.isLoading(false);
			}).fail(function (response) {
				self.errors($t('Error during currency conversion!'));
            });
        };
	}
});