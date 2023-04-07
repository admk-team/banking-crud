const BASE_URL = "";

      // Display user records when the page loads
      window.onload = () => {
        getUsers();
      };

      // Function to get user records from API
      function getUsers() {
        axios.get(`${BASE_URL}transcation/read.php`)
          .then(response => {
            const users = response.data.body;
            const tbody = document.querySelector("table tbody");
            tbody.innerHTML = "";
            for (let user of users) {
              tbody.innerHTML += `
                <tr>
                  <td>${user.id}</td>
                  <td>${user.transcation_id}</td>
                  <td>${user.user_id}</td>
                  <td>${user.status}</td>
                
                </tr>
              `;
            }
          })
          .catch(error => {
            console.error(error);
          });
      }

      // Function to add a new user to the API
      document.querySelector("#add-transcation-form").addEventListener("submit", event => {
        event.preventDefault();

        const transcation_id = document.querySelector("#transcation-id").value;
        const user_id = document.querySelector("#user-id").value;
        const status = document.querySelector("#status").value;
    

        axios.post(`${BASE_URL}transcation/create.php`, { transcation_id , user_id , status})
          .then(response =>{
        // Display success message and refresh user records
        document.querySelector("#messages").innerHTML = "Transcation added successfully";
        getUsers();
      })
      .catch(error => {
        // Display error message
        document.querySelector("#messages").innerHTML = "Error adding Transcation";
        console.error(error);
      });
  });

//   // Function to pre-fill the update form with user data
//   function editUser(id) {
//     axios.get(`${BASE_URL}/transcation/update.php/${id}`)
//       .then(response => {
//         const user = response.data;
//         document.querySelector("#update-id").value = user.id;
//         document.querySelector("#update-name").value = user.name;
//         document.querySelector("#update-email").value = user.email;
//         document.querySelector("#update-phone").value = user.phone;
//       })
//       .catch(error => {
//         console.error(error);
//       });
//   }

  // Function to update an existing user in the API
  document.querySelector("#update-transcation-form").addEventListener("submit", event => {
    event.preventDefault();

    const id = document.querySelector("#update-id").value;
    const transcation_id = document.querySelector("#update-transcation-id").value;
        const user_id = document.querySelector("#update-user-id").value;
        const status = document.querySelector("#update-status").value;

    axios.put(`${BASE_URL}transcation/update.php`, { id , transcation_id , user_id , status})
      .then(response => {
        // Display success message and refresh user records
        document.querySelector("#messages").innerHTML = "transcation updated successfully";
        getUsers();
      })
      .catch(error => {
        // Display error message
        document.querySelector("#messages").innerHTML = "Error updating transcation";
        console.error(error);
      });
  });

  
    // Function to update an existing user in the API
    document.querySelector("#delete-transcation-form").addEventListener("submit", event => {
    event.preventDefault();

    const id = document.querySelector("#delete-id").value;

    axios.post(`${BASE_URL}transcation/delete.php`, { id })
      .then(response => {
        // Display success message and refresh user records
        document.querySelector("#messages").innerHTML = "User Deleted successfully";
        getUsers();
      })
      .catch(error => {
        // Display error message
        document.querySelector("#messages").innerHTML = "Error deleting user";
        console.error(error);
      });
  });



//   // Function to delete a user from the API
//   function deleteUser(id) {
//     if (confirm("Are you sure you want to delete this user?")) {
//       axios.delete(`${BASE_URL}/user/delete.php`)
//         .then(response => {
//           // Display success message and refresh user records
//           document.querySelector("#messages").innerHTML = "User deleted successfully";
//           getUsers();
//         })
//         .catch(error => {
//           // Display error message
//           document.querySelector("#messages").innerHTML = "Error deleting user";
//           console.error(error);
//         });
//     }
//   }