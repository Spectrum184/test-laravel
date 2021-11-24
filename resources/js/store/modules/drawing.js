import { getDrawings } from '@/api/drawing';

const state = {
  drawings: [],
  drawing: null,
};

const mutations = {
  SET_LIST_DRAWINGS: (state, data) => {
    state.drawings = data;
  },
  SET_DRAWING: (state, data) => {
    state.drawing = data;
  },
};

const actions = {
  getDrawings({ commit }, data) {
    return new Promise((resolve, reject) => {
      getDrawings(data)
        .then(response => {
          console.log(response);
          commit('SET_LIST_DRAWINGS', response.result);
          resolve();
        })
        .catch(error => {
          console.log(error);
          reject(error);
        });
    });
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
