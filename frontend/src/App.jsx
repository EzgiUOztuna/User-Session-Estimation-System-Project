import { useEffect, useState } from 'react'
import './App.css'

function App() {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetch('http://localhost/User-Session-Estimation-System-Project/backend/analyze.php')
      .then(response => response.json())
      .then(data => {
        console.log(data);
        setUsers(data);
      })
      .catch(error => console.error('Veri çekilirken hata oluştu:', error));
  }, []);

  return (
    <>
      <div className='user-container'>
        {users.map((user, index) => (
          <div key={index} className='user-card'>
            <h3>{user.name}</h3>
            <p>Son login: {user.lastLogin}</p>
            <p>Tahmin 1 (Ortalama Aralık): {user.predictionAvgInterval}</p>
            <p>Tahmin 2 (Patern): {user.predictionPattern}</p>
          </div>
        ))}
      </div>
    </>
  )
}

export default App
