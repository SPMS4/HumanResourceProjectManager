window.$=window.$||{},function(){$&&$.fn&&$.fn.select2&&$.fn.select2.amd&&(define=$.fn.select2.amd.define,require=$.fn.select2.amd.require),define("select2/i18n/nl",[],function(){return{errorLoading:function(){return"De resultaten konden niet worden geladen."},inputTooLong:function(e){var t=e.input.length-e.maximum,n="Gelieve "+t+" karakters te verwijderen";return n},inputTooShort:function(e){var t=e.minimum-e.input.length,n="Gelieve "+t+" of meer karakters in te voeren";return n},loadingMore:function(){return"Meer resultaten laden…"},maximumSelected:function(e){var t="Er kunnen maar "+e.maximum+" item";return e.maximum!=1&&(t+="s"),t+=" worden geselecteerd",t},noResults:function(){return"Geen resultaten gevonden…"},searching:function(){return"Zoeken…"}}}),require("jquery.select2"),$.fn.select2.amd={define:define,require:require}}();