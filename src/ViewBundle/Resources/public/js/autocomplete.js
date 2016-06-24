$(document).ready(function() {

    $(document).on('click', function(event) {
        hideLists();
    });

    // TODO: Refactor
    $('#as-travel_start_location_input, #as-travel_end_location_input').on('keyup click', function(event) {
        event.stopPropagation();

        var inputField = $(this);

        searchCity(inputField, event.type);
    });

    // Detect if every field is filled:
    // TODO: include date
    $('#location-start, #location-end').on('change', function(event) {
        console.log('change detected');
        var locationStart = $('#location-start'),
            locationEnd = $('#location-end');

        if (locationStart.val() != '' && locationEnd.val() != '') {
            console.log('all fields are filled');
        }
    });
});

function searchCity(inputField, eventType) {
    var loader = inputField.parent('div').parent('div').find('span i');

    // show loader
    toggleLoader(loader, true);

    if (inputField.val().length > 2 && eventType == 'keyup') {
        $.get(Routing.generate('city_autocomplete', {term: inputField.val()}), function(data) {
            // Hide loader
            toggleLoader(loader, false);

            var elements = parseResults(data.content);

            var ul = createList(inputField, elements);

            ul.css('visibility', 'visible');
            ul.css('opacity', '1');
        });
    } else {
        var data = [];
        // Hide loader
        toggleLoader(loader, false);

        var elements = parseResults(data);

        var ul = createList(inputField, elements);

        ul.css('visibility', 'visible');
        ul.css('opacity', '1');
    }

}

function parseResults(data) {
    // TODO: Provide translations
    if(data.length > 0) {
        data.unshift('Wyniki wyszukiwania:');
        data.push('divider');
    }
    data.push('Ostatnio wyszukiwane elementy:');
    data.push({id: 10, label: 'Świebodzin'});

    return data;
}

function toggleLoader(element, show) {
    if (show) {
        element.removeClass(element.data('icon'));
        element.addClass('fa-cog');
        element.addClass('fa-spin');
    } else {
        element.addClass(element.data('icon'));
        element.removeClass('fa-cog');
        element.removeClass('fa-spin');
    }
}

function createList(inputField, elements) {
    var ul = inputField.parent('div').find('ul');

    // Create main autocomplete list element
    if(ul.length == 0) {
        inputField.after('<ul class="dropdown-menu autocomplete"></ul>');
        ul = inputField.parent('div').find('ul');
    }

    // clear content
    ul.html('');

        for (i in elements) {
            if (typeof elements[i] == "object") {
                var element = $('<li data-id="' + elements[i].id + '" data-label="'+ elements[i].label +'"><a>' + elements[i].label + '<div class="ripple-container"></div></a></li>').appendTo(ul);
                element.on('click', function(event) {
                    event.stopPropagation();

                    var targetField = $('#' + inputField.data('target')),
                        li = $(event.target).parent('li');

                    inputField.prop('value', li.data('label'));
                    targetField.prop('value', li.data('id'));

                    targetField.trigger('change');

                    hideLists();

                })
            } else if (elements[i] == 'divider') {
                ul.append('<li class="divider"></li>');
            } else {
                ul.append('<li class="dropdown-header">' + elements[i] + '</li>');
            }
        }

    return ul;
}

function hideLists() {
    var ul = $('.autocomplete');

    ul.css('opacity', 0);
    ul.css('visibility', 'hidden');
}