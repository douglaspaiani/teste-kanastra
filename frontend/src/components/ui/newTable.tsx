import React, { useContext, useEffect } from 'react';
import axios from 'axios';
import '../css/newTable.css';
import { toast } from 'react-toastify';
import { DataContext } from '../contexts/dataContext';

const NewTable = () => {
    const { data, boletos, fetchData } = useContext(DataContext);

    useEffect(() => {
        fetchData();
    }, [fetchData]);

    const ButtonBoleto = async (event) => {
        event.preventDefault();
        await axios.get('http://127.0.0.1:8000/api/boletos');
        toast.success("Boletos enviados com sucesso!");
        setBoleto(0);
    }

    return (
        <div>
            <h1>Uploads de dados via CSV</h1>
            {boletos > 0 && (
            <button type='button' onClick={ButtonBoleto}>Enviar {boletos} boletos pendentes</button>
            )}
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>ID Governamental</th>
                        <th>Valor da Dívida</th>
                        <th>Data de Vencimento</th>
                        <th>ID de débito</th>
                    </tr>
                </thead>
                <tbody>
                    {data.map(item => (
                        <tr key={item.id}>
                            <td>{item.id}</td>
                            <td>{item.name}</td>
                            <td>{item.email}</td>
                            <td>{item.governmentId}</td>
                            <td>{item.debtAmount}</td>
                            <td>{item.debtDueDate}</td>
                            <td>{item.debtID}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default NewTable;
