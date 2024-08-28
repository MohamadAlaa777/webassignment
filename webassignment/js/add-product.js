document.getElementById('productType').addEventListener('change', function() {
      var type = this.value;
      var fieldsDiv = document.getElementById('typeSpecificFields');
      fieldsDiv.innerHTML = '';
  
      if (type === 'DVD') {
          fieldsDiv.innerHTML = `
              <label for="size">Size (MB):</label>
              <input type="number" id="size" name="size" step="0.01" required>
              <br>
              <small>Please, provide size</small>
          `;
      } else if (type === 'Book') {
          fieldsDiv.innerHTML = `
              <label for="weight">Weight (Kg):</label>
              <input type="number" id="weight" name="weight" step="0.01" required>
              <br>
              <small>Please, provide weight</small>
          `;
      } else if (type === 'Furniture') {
          fieldsDiv.innerHTML = `
              <label for="height">Height (cm):</label>
              <input type="number" id="height" name="height" step="0.01" required>
              <br>
              <label for="width">Width (cm):</label>
              <input type="number" id="width" name="width" step="0.01" required>
              <br>
              <label for="length">Length (cm):</label>
              <input type="number" id="length" name="length" step="0.01" required>
              <br>
              <small>Please, provide dimensions</small>
          `;
      }
  });
  