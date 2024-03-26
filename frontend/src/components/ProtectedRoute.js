import React, { useEffect } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const Home = () => {
  const navigate = useNavigate();

  useEffect(() => {
    const checkUserAuthentication = async () => {
      try {
        const response = await axios.get('http://localhost:8000/api/user', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          }
        });
        console.log(response.data.user);
      } catch (error) {
        if (error.response && error.response.status === 401) {
          navigate('/login');
        }
      }
    };

    checkUserAuthentication();
  }, [navigate]);

 
};

export default Home;
