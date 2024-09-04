/* jshint esversion: 6 */
(function () {
  "use strict";
  document.addEventListener('DOMContentLoaded', init);

  function init() {
    const
      contentElement = document.querySelector('.tx_dinosaurfinder'),
      properties = contentElement.querySelector('.properties'),
      filtersContainer = properties.querySelector('.filters'),
      filters = filtersContainer.querySelectorAll('.filter'),
      container = contentElement.querySelector('.content'),
      resetButton = contentElement.querySelector('button.reset');

    filtersContainer.addEventListener('change', sendAjaxRequest);
    resetButton.addEventListener('click', resetFilters);

    function sendAjaxRequest() {
      const filterData = {};
      filterData.id = contentElement.dataset.id;
      filterData.hash = contentElement.dataset.hash;
      filterData.languageKey = contentElement.dataset.languageKey;
      filterData.constraints = {};
      filters.forEach(element => {
        const filterName = element.dataset.filterName;
        if (element.value) {
          filterData.constraints[filterName] = element.value;
        }
      });

      const xhr = new XMLHttpRequest();
      xhr.open('POST', '/tx_dinosaurfinder', true);
      xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          properties.innerHTML = response.properties;
          container.innerHTML = response.dinosaurs;
          init();
        }
      };
      xhr.send(JSON.stringify(filterData));
    }

    function resetFilters() {
      filters.forEach(filter => {
        filter.value = '';
      });
      sendAjaxRequest();
    }
  }
})();
