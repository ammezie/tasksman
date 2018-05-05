import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'

export default class ProjectsList extends Component {
  constructor () {
    super()

    this.state = {
      projects: []
    }
  }

  componentDidMount () {
    axios.get('/projects').then(response => {
      this.setState({
        projects: response.data
      })
    })
  }

  render () {
    return (
      <div className='card'>
        <div className='card-header'>All projects</div>

        <div className='card-body'>
          <a className='btn btn-primary btn-sm mb-3' href='projects/create'>
            Create new project
          </a>

          <ul className='list-group list-group-flush'>
            {this.state.projects.map(project => (
              <a
                className='list-group-item list-group-item-action d-flex justify-content-between align-items-center'
                href='`projects/${project.id}`'
                key={project.id}
              >
                {project.name}
                <span className='badge badge-primary badge-pill'>
                  {project.tasks_count}
                </span>
              </a>
            ))}
          </ul>
        </div>
      </div>
    )
  }
}

if (document.getElementById('projects-list')) {
  ReactDOM.render(<ProjectsList />, document.getElementById('projects-list'))
}
