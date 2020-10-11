import { date } from 'quasar';
export default function DeveloperEntity(userData = {}) {

    this.id = userData.id;
    this.nome = userData.nome;
    this.idade = userData.idade;
    this.hobby = userData.hobby;
    this.sexo = userData.sexo || "M";
    this.datanascimento = date.formatDate(userData.datanascimento, 'DD/MM/YYYY');
    
    this.getId = () => {
        return this.id;
    }
    this.getNome = () => {
        return this.nome;
    }
    this.getIdade = () => {
        return this.idade;
    }
    this.getHobby = () => {
        return this.hobby;
    }
    this.getSexo = () => {
        return this.sexo;
    }
    this.getDatanascimento = () => {
        return this.datanascimento;
    }

    this.getDatadascimentoIso = () => {
        return this.datanascimento ? date.formatDate(date.extractDate(this.datanascimento, 'DD/MM/YYYY'), "YYYY-MM-DD"): "";
    }
}
