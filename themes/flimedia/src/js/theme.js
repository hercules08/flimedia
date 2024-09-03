// Block - Product Carousel Customization

function fadeActiveSlideContentOnSlideChange(control) {
  let slider = control.parentNode.parentNode;
  let activeSlide = slider.querySelector(".splide__slide.is-visible");
  let activeSlideId = activeSlide.id;

  // Must do it by adding and removing a class rather than updating style object or it will not come back in when active again
  document.getElementById(activeSlideId).classList.add("content-hidden");
  setTimeout(() => {
    document.getElementById(activeSlideId).classList.remove("content-hidden");
  }, 500);
}

// Custom - Accordion
function activateCustomAccordions() {
    const accordions = document.querySelectorAll('.accordion-custom .accordion-item');

    accordions.forEach(function(accordion) {
      const header = accordion.querySelector('.accordion-header');
      const content = accordion.querySelector('.accordion-content');

      if (accordion.classList.contains('active')) {
        content.style.maxHeight = content.scrollHeight + 30 + 'px';
      } else {  
        content.style.maxHeight = '0';
      }

      header.addEventListener('click', function() {
        accordion.classList.toggle('active');

        if (accordion.classList.contains('active')) {
          content.style.maxHeight = content.scrollHeight + 30 + 'px';
        } else {
          content.style.maxHeight = '0';
        }
      });
    });

}

// Custom - Inventory Availablity Modal
function activateInventoryModal() {
  let modalLinks = document.querySelectorAll('.inventory-modal-trigger');
  const body = document.querySelector('body');

  modalLinks.forEach(function(link) {
    link.onclick = function(event) {
      event.preventDefault(); 

      const modalId = link.getAttribute('data-modal-id'); 
      const modal = document.getElementById(modalId);
      const year = link.getAttribute('data-year');
      const make = link.getAttribute('data-make');
      const model = link.getAttribute('data-model');
      const series = link.getAttribute('data-series');
      let seriesText = '';
      if (series !== '') { seriesText = series; } else { seriesText = ''; }
      const inventoryTitle = year + ' ' + make + ' ' + model + ' ' + seriesText;

      const vin = link.getAttribute('data-vin');
      const stock = link.getAttribute('data-stock');

      if (modal) {
        let titleElement = modal.querySelector('#inventory');
        let yearInput = modal.querySelector('#input_3_7');
        let makeInput = modal.querySelector('#input_3_12');
        let modelInput = modal.querySelector('#input_3_13');
        let seriesInput = modal.querySelector('#input_3_14');
        let vinElement = modal.querySelector('#vin');
        let vinInput = modal.querySelector('#input_3_8')
        let stockElement = modal.querySelector('#stock');
        let stockInput = modal.querySelector('#input_3_9');
        titleElement.innerHTML = inventoryTitle;
        yearInput.value = year;
        makeInput.value = make;
        modelInput.value = model;
        seriesInput.value = series;
        vinElement.innerHTML = vin;
        vinInput.value = vin;
        stockElement.innerHTML = stock;
        stockInput.value = stock;
        modal.style.display = 'flex';
        body.style.overflow = 'hidden';
      }
    };
  });

  const closeButtons = document.querySelectorAll('.custom-modal-close');

  closeButtons.forEach(function(button) {
    button.onclick = function() {
      const modal = button.closest('.custom-modal-overlay'); 
      let formReloadLink = document.querySelector('#gform_confirmation_message_3 .gws-reload-form');
      if (modal) {
        modal.style.display = 'none'; 
        body.style.overflow = 'auto';
      }
      if(formReloadLink) {
        formReloadLink.click();
      }
    };
  });

  window.onclick = function(event) {
    if (event.target.classList.contains('custom-modal-overlay')) {
      let formReloadLink = document.querySelector('#gform_confirmation_message_3 .gws-reload-form');
      event.target.style.display = 'none';
      body.style.overflow = 'auto';
      if(formReloadLink) {
        formReloadLink.click();
      }
    }
  };
}

//////////////////////////////////////
// Mobile Filters 
/////////////////////////////////////////

let tabletMax = 998.98;

function positionMobileFilters() {
  const filters = document.getElementById('filter-accordions');
  
  if(filters) {  
    const header = document.getElementById('header');
    const adminBar = document.getElementById('wpadminbar');
    const body = document.querySelector('body');
    const filtersSection = document.querySelector('.inventory-filters');
    const filtersContainer = document.getElementById('filters-wrapper');
    const filtersHeader = document.getElementById('filters-header');
    const applyFiltersBtn = document.getElementById('applyFilters');
    let filtersHeaderHeight = filtersHeader.getBoundingClientRect().height;
    let headerHeight = header.getBoundingClientRect().height + (adminBar ? adminBar.getBoundingClientRect().height : 0);

    filtersHeader.removeEventListener('click', openCloseMobileFilters);
    filtersSection.style.paddingTop = filtersHeaderHeight + 'px';
    filtersContainer.style.top = headerHeight + 'px';
    filters.style.height = (window.innerHeight - headerHeight - filtersHeaderHeight) + 'px';
    if (!filters.classList.contains('filters-open')) {
      filters.style.top = '-'+ (window.innerHeight - headerHeight - filtersHeaderHeight) + 'px';
      body.style.overflow = 'auto';
    } else {
      body.style.overflow = 'hidden';
    }
    // open and close filters
    filtersHeader.addEventListener('click', openCloseMobileFilters);
    applyFiltersBtn.addEventListener('click', openCloseMobileFilters);
  }

}

function openCloseMobileFilters() {
  const header = document.getElementById('header');
  const adminBar = document.getElementById('wpadminbar');
  const filters = document.getElementById('filter-accordions');
  const body = document.querySelector('body');
  const filtersHeader = document.getElementById('filters-header');
  let filtersHeaderHeight = filtersHeader.getBoundingClientRect().height;
  let headerHeight = header.getBoundingClientRect().height + (adminBar ? adminBar.getBoundingClientRect().height : 0);

  if (filters.classList.contains('filters-open')) {
    filters.style.top = '-'+ (window.innerHeight - headerHeight - filtersHeaderHeight) + 'px';
    filters.classList.remove('filters-open');
    filtersHeader.classList.remove('filters-open');
    body.style.overflow = 'auto';
  } else {
    filters.style.top = filtersHeaderHeight + 'px';
    filters.classList.add('filters-open');
    filtersHeader.classList.add('filters-open');
    body.style.overflow = 'hidden';
  }
}

function resetFiltersSizing() {
  const filters = document.getElementById('filter-accordions');
  const filtersSection = document.querySelector('.inventory-filters');
  const body = document.querySelector('body');
  
  if(filters) {
    filtersSection.style.paddingTop = '0px';
    filters.style.height = 'auto';
    body.style.overflow = 'auto';
  }
}

function disableCarouselWhenOneSlide() {
  let carousels = document.querySelectorAll('.kt-blocks-carousel');
  carousels.forEach(function(carousel) {
    let slideCount = carousel.querySelector('.splide__list').children.length;
    if(slideCount === 1) {
      carousel.classList.add('one-slide');
    }
  });
}

function hideEmptyFacetGroups() {

  let facetGroups = document.querySelectorAll('.facet-group');
  
  facetGroups.forEach(function(group) {
    let allEmpty = true;
    let groupFacets = group.querySelectorAll('.facetwp-facet');
    
    groupFacets.forEach(function(facet) {
      if (facet.children.length) {
        allEmpty = false;
        return;
      }
    });
    
    if (allEmpty) {
      // console.log('hiding facet group: ', group);
      group.style.display = "none";
    }
  });
}

// ON LOAD EVENTS

window.addEventListener(
  "load",
  function () {
    // activate custom inventory modal
    activateInventoryModal();
    // disable carousels when only 1 image present
    disableCarouselWhenOneSlide();
    
    // hide emptry facet groups
    if (typeof FWP !== 'undefined') {
      hideEmptyFacetGroups();
    }

    // position mobile filters
    if (window.innerWidth <= tabletMax) {
      positionMobileFilters();
    }
    // Activate custom accordions - delayed for FWP loading on filter page
    setTimeout(() => {
      activateCustomAccordions();
    }, 100);
    
    
    // Add event listener to product carousel arrows once they are loaded
    document.body.addEventListener("click", function (e) {
      if (
        e.target.classList.contains("splide__arrow") &&
        e.target.closest(".custom-product-carousel")
      ) {
        fadeActiveSlideContentOnSlideChange(e.target);
      }
    });
  },
  false
);

// RESIZE EVENTS

let resizeTimer;

window.addEventListener('resize', function(event) {
	if(resizeTimer) {
		window.clearTimeout(resizeTimer);
	}

	resizeTimer = window.setTimeout(function() {

    if (window.innerWidth <= tabletMax) {
      positionMobileFilters();
    } else {
      resetFiltersSizing();
    }

	}, 100);
});


document.addEventListener('facetwp-loaded', function() {
  if (FWP.loaded) {
      activateInventoryModal();
    ;
  }

});



// ON SCROLL EVENTS

// let scrollTimer;

// window.addEventListener('scroll', function(event) {
// 	if(scrollTimer) {
// 		window.clearTimeout(scrollTimer);
// 	}

// 	scrollTimer = window.setTimeout(function() {
// 		// callback function
// 	}, 100);
// });

