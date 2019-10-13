( function( api ) {

	// Extends our custom "vw-one-page" section.
	api.sectionConstructor['vw-one-page'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );