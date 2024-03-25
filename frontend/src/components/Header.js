import React from 'react';
import { Link } from 'react-router-dom';

const Header = () => {
  return (
    <nav className="navbar row py-3 navbar-expand-lg shadow  navbar-light px-4 bg-light">
      <a className="navbar-brand col-md-4 fw-bold" href="/">my<span className='text-primary'>Wallet</span> </a>
      <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span className="navbar-toggler-icon"></span>
      </button>

      <div className="collapse col-md-4 container navbar-collapse  d-flex px-4 justify-content-between" id="navbarSupportedContent">
        <ul className="navbar-nav mr-auto">
          <li className="nav-item active">
            <a className="nav-link" href="/">Home </a>
          </li>
          <li className="nav-item">
            <Link className="nav-link" to="/TransactionPages">transactions</Link>
          </li>
          <li className="nav-item">
            <a className="nav-link" href="/accounts">Accounts</a>
          </li>
        </ul>
        <div className="form-inline my-2 my-lg-0">
          <a href='/login' className="btn btn-outline-primary my-2 my-sm-0 mr-2" type="submit">Login</a>
          <a href='/register' className="btn btn-primary my-2 my-sm-0" type="submit">Register</a>
        </div>
      </div>
    </nav>
  );
}

export default Header;
