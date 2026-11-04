The upgrade instructions are available at [Oro documentation website](https://doc.oroinc.com/master/backend/setup/upgrade-to-new-version/).

The current file describes significant changes in the code that may affect the upgrade of your customizations.

## UNRELEASED

### Removed

#### GoldenCarbonThemeBundle, IntelligentBlueThemeBundle
* Removed the `order_default` and `invoice_default` PDF document templates (`content.html.twig`, `header.html.twig`, `footer.html.twig`) and their `pdf_document` entries in `theme.yml`. The `golden_carbon` and `intelligent_blue` themes now use the templates registered by the `default` theme, which take the styles built for the current theme. A theme that extended one of the removed templates should extend `@OroOrder/layouts/default/twig/pdf_document/order_default/*.html.twig` or `@OroCommerceInvoice/layouts/default/twig/pdf_document/invoice_default/*.html.twig` instead.
