import React, { createContext, useState } from 'react';
import axios from 'axios';

export const DataContext = createContext();

export const DataProvider = ({ children }) => {
    const [data, setData] = useState([]);
    const [boletos, setBoleto] = useState(0);

    const fetchData = async () => {
        // Supondo que você tenha uma função para buscar os dados da API
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/list');
            setData(response.data.data.list);
            setBoleto(response.data.data.boletos_pendentes);
        } catch (error) {
            console.error('Erro ao buscar dados da API:', error);
        }
    };

    return (
        <DataContext.Provider value={{ data, boletos, fetchData }}>
            {children}
        </DataContext.Provider>
    );
};