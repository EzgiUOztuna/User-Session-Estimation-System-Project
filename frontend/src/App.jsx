import { useEffect, useState } from 'react';
import './App.css';

function App() {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetch('http://localhost:8080/api.php')
      .then(response => response.json())
      .then(data => {
        console.log(data);
        setUsers(Array.isArray(data) ? data : []);
      })
      .catch(error => console.error('Veri çekilirken hata oluştu:', error));
  }, []);

  return (
    <div className="container">
      <h1>Kullanıcı Login Tahmin Sistemi</h1>
      <table>
        <thead>
          <tr>
            <th>İsim</th>
            <th>Son Giriş</th>
            <th>Ortalama Aralık Tahmini</th>
            <th>Ertesi Gün Aynı Saat</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user) => (
            <tr key={user.id}>
              <td>{user.name}</td>
              <td>{new Date(user.last_login).toLocaleString()}</td>
              <td>{new Date(user.predictions.average_interval).toLocaleString()}</td>
              <td>{new Date(user.predictions.next_day_same_time).toLocaleString()}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default App;
