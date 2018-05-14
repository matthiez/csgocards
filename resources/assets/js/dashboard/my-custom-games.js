export default () => {
  /*
'use strict';

(function () {
  const URL = {
      delete: 'poker/deleteCustomGames'
  };

  const UI = {
      deleteCustomGames: document.getElementById('delete_custom_games')
  };

  window.customGameIds = new Proxy([], {
      get: function(target, property) {
          return target[property];
      },

      apply: function(target, thisArg, args) {
          return thisArg[target].apply(this, args);
      },

      deleteProperty: function(target, property) {
          console.log(`Deleted property '${property}' from customGameIds`);
          return true;
      },

      set: function(target, property, value, receiver) {
          target[property] = value;
          console.log(`Set index '${property}' to value '${value}' in customGameIds`);
          UI.deleteCustomGames.disabled = target.length <= 0;
          return true;
      }
  });

  const table = document.getElementById('my_custom_games');
  const toggleAll = table.querySelector('thead .mdl-data-table__select input');
  const tbodyRows = table.querySelectorAll('tbody .mdl-data-table__select');

  toggleAll.addEventListener('change', ev => {
      window.customGameIds.length = 0;
      if (ev.target.checked) {
          for (let i = 0, length = tbodyRows.length; i < length; i++) {
              tbodyRows[i].MaterialCheckbox.check();
              window.customGameIds.push(tbodyRows[i].dataset.id);
          }
      }
      else for (let i = 0, length = tbodyRows.length; i < length; i++) tbodyRows[i].MaterialCheckbox.uncheck();
  });

  (function() {
      for (let tbodyRow of tbodyRows) {
          tbodyRow.addEventListener('change', function(ev) {
              if (ev.target.checked && !window.customGameIds.includes(tbodyRow.dataset.id)) window.customGameIds.push(tbodyRow.dataset.id);
              else {
                  const i = window.customGameIds.indexOf(tbodyRow.dataset.id);
                  if (i > -1) window.customGameIds.splice(i, 1);
              }
          });
      }
  })();

  UI.deleteCustomGames.addEventListener('click', function() {
      App.Fetch.post({
          url: URL.delete,
          body: {
              customGameIds: window.customGameIds
          }
      }).then(function(data) {
          for (let customGameId of window.customGameIds) table.querySelector("tbody > tr[data-id='"+customGameId+"']").remove();
          toggleAll.classList.remove('is-checked');
          App.notice({
              data: data,
              type: 'success'
          });
      }).catch(function(err) {
          App.notice({
              data: err,
              type: 'error'
          });
      });
  });
})();*/
}