import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'

export default class NewProject extends Component {
  constructor () {
    super()

    this.state = {
      name: '',
      description: '',
      errors: []
    }

    this.handleChange = this.handleChange.bind(this)
    this.handleSubmit = this.handleSubmit.bind(this)
    this.hasErrorFor = this.hasErrorFor.bind(this)
    this.renderErrorFor = this.renderErrorFor.bind(this)
  }

  handleChange (event) {
    this.setState({
      [event.target.name]: event.target.value
    })
  }

  handleSubmit (event) {
    event.preventDefault()

    const project = {
      name: this.state.name,
      description: this.state.description
    }

    axios
      .post('/projects', project)
      .then(response => {
        // redirect to the homepage
        window.location = '/'
      })
      .catch(error => {
        this.setState({
          errors: error.response.data.errors
        })
      })
  }

  hasErrorFor (field) {
    return !!this.state.errors[field]
  }

  renderErrorFor (field) {
    if (this.hasErrorFor(field)) {
      return (
        <span className='invalid-feedback'>
          <strong>{this.state.errors[field][0]}</strong>
        </span>
      )
    }
  }

  render () {
    return (
      <div className='card'>
        <div className='card-header'>Create new project</div>

        <div className='card-body'>

          <form onSubmit={this.handleSubmit}>

            <div className='form-group'>
              <label htmlFor='name'>Project name</label>
              <input
                id='name'
                type='text'
                className={`form-control ${this.hasErrorFor('name') ? 'is-invalid' : ''}`}
                name='name'
                onChange={this.handleChange}
              />
              {this.renderErrorFor('name')}
            </div>

            <div className='form-group'>
              <label htmlFor='description'>Project description</label>
              <textarea
                id='description'
                className={`form-control ${this.hasErrorFor('description') ? 'is-invalid' : ''}`}
                name='description'
                rows='10'
                onChange={this.handleChange}
              />

              {this.renderErrorFor('description')}
            </div>

            <button className='btn btn-primary'>Create</button>
          </form>

        </div>
      </div>
    )
  }
}

if (document.getElementById('new-project')) {
  ReactDOM.render(<NewProject />, document.getElementById('new-project'))
}
