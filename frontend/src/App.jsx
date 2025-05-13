import { useEffect, useState } from 'react';
import './App.css';

function App() {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetch('http://localhost:8080/api.php')
      .then(response => response.json())
      .then(data => {
        console.log(data); // Veriyi konsola yazdırarak ne geldiğini kontrol edin.
        setUsers(Array.isArray(data) ? data : []); // Eğer dizi değilse, boş dizi olarak set et
      })
      .catch(error => console.error('Veri çekilirken hata oluştu:', error));
  }, []);



  return <>
    <div className="App">
      <h1>Kullanıcı Login Saatleri</h1>
      <table border="1">
        <thead>
          <tr>
            <th>Kullanıcı</th>
            <th>Login Saatleri</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user) => (
            <tr key={user.id}>
              <td>{user.name}</td>
              <td>
                <ul>
                  {user.logins.map((login, index) => (
                    <li key={index}>{login}</li>
                  ))}
                </ul>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  </>
}

export default App;
