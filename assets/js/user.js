const BASE_URL = "";

// Display user records when the page loads
window.onload = () => {
  getUsers();
};

// Function to get user records from API
function getUsers() {
  axios.get(`${BASE_URL}user/read.php`)
    .then(response => {
      const users = response.data.body;
      console.log(users);
      const tbody = document.querySelector("table tbody");
      tbody.innerHTML = "";
      for (let user of users) {
        tbody.innerHTML += `
          <tr>
            <td>${user.id}</td>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.phone}</td>
         
          </tr>
        `;
      }
    })
    .catch(error => {
      console.error(error);
    });
}

// Function to add a new user to the API
document.querySelector("#add-user-form").addEventListener("submit", event => {
  event.preventDefault();

  const name = document.querySelector("#name").value;
  const email = document.querySelector("#email").value;
  const phone = document.querySelector("#phone").value;

  axios.post(`${BASE_URL}user/create.php`, { name, email , phone })
    .then(response =>{
  // Display success message and refresh user records
  document.querySelector("#messages").innerHTML = "User added successfully";
  getUsers();
})
.catch(error => {
  // Display error message
  document.querySelector("#messages").innerHTML = "Error adding user";
  console.error(error);
});
});

// // Function to pre-fill the update form with user data
// function editUser(id) {
//   axios.get(`${BASE_URL}/user/update.php/${id}`)
//     .then(response => {
//       const user = response.data;
//       document.querySelector("#update-id").value = user.id;
//       document.querySelector("#update-name").value = user.name;
//       document.querySelector("#update-email").value = user.email;
//       document.querySelector("#update-phone").value = user.phone;
//     })
//     .catch(error => {
//       console.error(error);
//     });
// }

// Function to update an existing user in the API
document.querySelector("#update-user-form").addEventListener("submit", event => {
event.preventDefault();

const id = document.querySelector("#update-id").value;
const name = document.querySelector("#update-name").value;
const email = document.querySelector("#update-email").value;
const phone =  document.querySelector("#update-phone").value ;

axios.put(`${BASE_URL}user/update.php`, { id ,  name, email , phone })
.then(response => {
  // Display success message and refresh user records
  document.querySelector("#messages").innerHTML = "User updated successfully";
  getUsers();
})
.catch(error => {
  // Display error message
  document.querySelector("#messages").innerHTML = "Error updating user";
  console.error(error);
});
});


// Function to update an existing user in the API
document.querySelector("#delete-user-form").addEventListener("submit", event => {
event.preventDefault();

const id = document.querySelector("#delete-id").value;

axios.post(`${BASE_URL}user/delete.php`, { id })
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
